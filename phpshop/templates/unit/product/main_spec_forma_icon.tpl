<div class="col-md-3 col-sm-3 col-xs-12 product-block-wrapper-fix">
     <div class="thumbnail">
        <span class="sale-icon-content d-flex flex-column align-items-start">
            @promotionsIcon@
            @newtipIcon@
            @hitIcon@
            
        </span>
        <div class="product-btn"> <button class=" addToCompareList " role="button" data-uid="@productUid@"><span class="icons icons-green icons-small icons-compare"></span></button>
         <a class=" addToWishList @elementCartOptionHide@" href="/shop/UID_@productUid@.html"><span class="icons icons-green icons-small icons-wishlist"></span></a>
         <button class=" addToWishList @elementCartHide@" role="button" data-uid="@productUid@"><span class="icons icons-green icons-small icons-wishlist"></span></button></div>
        <div class="caption ">
        <a href="/shop/UID_@productUid@.html" title="@productName@">
            <div class="product-image position-relative">
                <img data-src="@productImg@" alt="@productName@" class="swiper-lazy" src="@productImg@">
            </div>

            <div class="product-name">@productName@</div>
             <div class="stock">
                @previewSorts@

            </div>
            <div class="rating">
            @rateCid@
        </div>

        </a>
            <div class="d-flex justify-content-between align-items-end">
            
                <div class="product-price d-flex flex-column align-items-start justify-content-end">
                    <div class=" price-old @php __hide('productPriceOld'); php@"  >@productPriceOld@</div>
                    <div class="price-new">@productPrice@<span class="rubznak">@productValutaName@</span></div>

                </div>
                <div class="d-flex flex-column align-items-end justify-content-end"> <span class="">
                        @specIcon@</span>
                    <a class=" addToCartList @elementCartOptionHide@" href="/shop/UID_@productUid@.html">@productSale@ <span class="icons icons-cart"></span></a>
                    <button class=" addToCartList @elementCartHide@" data-uid="@productUid@" role="button">@productSale@ <span class="icons icons-cart"></span></button>
                         <button class="notice-btn  @elementNoticeHide@" title="@productNotice@" data-product-id="@productUid@">
                @productNotice@
            </button>
                </div>
            </div>
           
        </div>
        <div class="caption">

       


        </div>
    </div>
</div>