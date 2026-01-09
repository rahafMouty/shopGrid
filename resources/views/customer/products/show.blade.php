@extends('layouts.main')

@section('title', $product->name)
<style>
    .border-left-primary { border-left: 5px solid #3b5dcd !important; }

    /* الحالة الافتراضية: عرض جزء بسيط من النص */
    .ai-content-wrapper.collapsed {
        max-height: 80px; /* يعرض حوالي سطرين أو ثلاثة */
        overflow: hidden;
        position: relative;
    }

    /* تأثير التلاشي في نهاية النص المقصوص */
    .ai-content-wrapper.collapsed::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: linear-gradient(transparent, white);
    }

    /* الحالة المفتوحة */
    .ai-content-wrapper.expanded {
        max-height: none;
    }

    .ai-generated-content {
        font-size: 14px;
        line-height: 1.6;
        color: #555;
    }
</style>
@section('content')
<section class="item-details section">
    <div class="container">
        <div class="top-area">
            <div class="row align-items-center">

                {{-- صورة المنتج --}}
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-images">
                        <div class="main-img">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                {{-- معلومات المنتج --}}
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-info">
                        <h2 class="title">{{ $product->name }}</h2>
                        <p class="category">
                            <i class="lni lni-tag"></i>
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </p>
                        <h3 class="price">${{ number_format($product->price, 2) }}</h3>
                        <p class="info-text">{{ $product->description }}</p>

                        <button onclick="generateAI('{{ $product->id }}')" 
                                id="btn-{{ $product->id }}"
                                class="btn btn-lg btn-outline-primary mt-2" style="font-size: 20px;">
                            <i class="lni lni-reload"></i> Generate AI Description
                        </button>

                        {{-- اختيار الكمية --}}
                        <div class="form-group quantity mb-3">
                            <label for="quantity">Quantity</label>
                            <select id="quantity-select" class="form-control">
                                @for($i = 1; $i <= $product->stock_quantity; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- زر إضافة إلى السلة --}}
                            <button class="btn btn-success btn-lg btn-block"
                                    data-id="{{ $product->id }}"
                                    id="add-to-cart-btn">
                                Add to Cart
                            </button>
                            <div id="cart-message" style="margin-bottom:15px;"></div>



                            {{-- حاوية وصف الذكاء الاصطناعي --}}
<div id="ai-description-container" class="mt-4 p-4 border-left-primary shadow-sm bg-white rounded" 
     style="{{ $product->ai_description ? 'display: block;' : 'display: none;' }}">
    
    <div class="d-flex align-items-center mb-2">
        <i class="lni lni-ai text-primary mr-2" style="font-size: 24px;"></i>
        <h5 class="mb-0 text-dark">AI Description</h5>
    </div>
    
    <hr>

    {{-- النص المولد مع خاصية القص --}}
    <div id="desc-wrapper-{{ $product->id }}" class="ai-content-wrapper collapsed">
        <div id="desc-{{ $product->id }}" class="ai-generated-content">
            {!! nl2br(e($product->ai_description)) !!}
        </div>
    </div>

    {{-- زر إظهار المزيد --}}
    <button id="toggle-btn-{{ $product->id }}" onclick="toggleDescription('{{ $product->id }}')" 
            class="btn btn-link btn-sm p-0 mt-2" style="{{ $product->ai_description ? 'display: block;' : 'display: none;' }}">
        Show More...
    </button>
</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- تفاصيل إضافية --}}
        <div class="product-details-info mt-4">
            <h4>Details</h4>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</section>
@endsection


@push('scripts')
<script>
document.getElementById('add-to-cart-btn').addEventListener('click', function() {
    const productId = this.dataset.id;
    const quantity = document.getElementById('quantity-select').value;
    const messageDiv = document.getElementById('cart-message');

    // تنظيف الرسائل السابقة
    messageDiv.innerHTML = '';
    messageDiv.className = '';

    fetch(`/customer/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(async res => {
        const data = await res.json();
        if (res.ok) {
            // رسالة نجاح
            messageDiv.className = 'alert alert-success';
            messageDiv.textContent = data.message || 'Product added to cart';
        } else {
            // رسالة خطأ
            messageDiv.className = 'alert alert-danger';
            messageDiv.textContent = data.message || 'Failed to add product to cart';
        }
    })
    .catch(err => {
        messageDiv.className = 'alert alert-danger';
        messageDiv.textContent = 'Error adding product to cart';
        console.error(err);
    });
});
</script>

<script>
function addToCart(productId) {
    const quantity = document.getElementById('quantity-select').value;

    fetch(`/customer/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(res => res.json())
    .then(data => {
        if(data.message){
            alert(data.message);
        } else {
            alert('Product added to cart');
        }
    })
    .catch(err => {
        alert('Error adding product to cart');
        console.error(err);
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function generateAI(productId) {
    const btn = document.getElementById(`btn-${productId}`);
    const descText = document.getElementById(`desc-${productId}`);
    
    btn.disabled = true;
    btn.innerHTML = 'Generating...';

    // توليد الرابط باستخدام اسم الرابط (Route Name)
    let url = "{{ route('admin.products.generateDescription', ':id') }}";
    url = url.replace(':id', productId);

    // استخدام GET بدلاً من POST
    fetch(url)
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            descText.innerText = data.description.substring(0, 50) + '...';
            Swal.fire('Success!', 'Description generated.', 'success');
        } else {
            console.error('Failure:', data);
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(err => {
        console.error('Console Error:', err);
        Swal.fire('Error', 'Something went wrong', 'error');
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = 'Generate AI Description';
    });
}

// وظيفة التوسيع والإغلاق
function toggleDescription(productId) {
    const wrapper = document.getElementById(`desc-wrapper-${productId}`);
    const btn = document.getElementById(`toggle-btn-${productId}`);

    if (wrapper.classList.contains('collapsed')) {
        wrapper.classList.remove('collapsed');
        wrapper.classList.add('expanded');
        btn.innerText = 'Show Less';
    } else {
        wrapper.classList.add('collapsed');
        wrapper.classList.remove('expanded');
        btn.innerText = 'Show More...';
    }
}

// تحديث وظيفة التوليد الأصلية لتتعامل مع الزر الجديد
function generateAI(productId) {
    const btn = document.getElementById(`btn-${productId}`);
    const container = document.getElementById('ai-description-container');
    const contentArea = document.getElementById(`desc-${productId}`);
    const toggleBtn = document.getElementById(`toggle-btn-${productId}`);
    
    btn.disabled = true;
    btn.innerHTML = 'Generating...';

    let url = "{{ route('admin.products.generateDescription', ':id') }}";
    url = url.replace(':id', productId);

    fetch(url)
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            container.style.display = 'block';
            toggleBtn.style.display = 'block';
            contentArea.innerHTML = data.description.replace(/\n/g, "<br>");
            
            Swal.fire('Success', 'AI Description Updated', 'success');
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(err => Swal.fire('Error', 'Connection failed', 'error'))
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = 'Generate AI Description';
    });
}
</script>
@endpush
