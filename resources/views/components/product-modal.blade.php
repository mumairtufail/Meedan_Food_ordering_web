@props(['show' => false, 'product' => null])

<div
    @open-product-modal.window="open($event.detail)"
    x-data="{
        show: false,
        product: null,
        qty: 1,
        addons: [],
        totalPrice: 0,
        
        init() {
            this.$watch('show', value => {
                if (value) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = null;
                    setTimeout(() => this.reset(), 300);
                }
            });
        },

        open(productData) {
            this.product = productData;
            this.calculateTotal();
            this.show = true;
        },

        close() {
            this.show = false;
        },

        reset() {
            this.product = null;
            this.qty = 1;
            this.addons = [];
            this.totalPrice = 0;
        },

        toggleAddon(addon) {
            const index = this.addons.indexOf(addon.id);
            if (index === -1) {
                this.addons.push(addon.id);
            } else {
                this.addons.splice(index, 1);
            }
            this.calculateTotal();
        },

        calculateTotal() {
            // Simplified calculation removed for external ordering
        }
    }"
    @open-product-modal.window="open($event.detail)"
    x-show="show"
    style="display: none;"
    class="relative z-50"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    <!-- Background backdrop -->
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        @click="close()"
    ></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
            >
                <template x-if="product">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" :value="product.id">
                        
                        <!-- Header Image -->
                        <div class="relative h-48 sm:h-56 bg-gray-100">
                             <img :src="product.image_url" :alt="product.name" class="w-full h-full object-cover">
                             <button type="button" @click="close()" class="absolute top-4 right-4 bg-white/10 backdrop-blur-md hover:bg-white/20 text-white rounded-full p-2 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                             </button>
                        </div>

                        <div class="p-6">
                            <div class="mb-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-2xl font-bold text-gray-900" x-text="product.name"></h3>
                                    <span class="text-xl font-bold text-primary" x-text="'$' + parseFloat(product.price).toFixed(2)"></span>
                                </div>
                                <p class="text-gray-500 text-sm leading-relaxed" x-text="product.description"></p>
                            </div>

                            <!-- Addons Section -->
                            <template x-if="product.addons && product.addons.length > 0">
                                <div class="mb-6">
                                    <h4 class="font-bold text-gray-900 mb-3 text-sm uppercase tracking-wider">Customize</h4>
                                    <div class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                        <template x-for="addon in product.addons" :key="addon.id">
                                            <label class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:border-primary/30 cursor-pointer bg-gray-50 hover:bg-white transition-all">
                                                <div class="flex items-center gap-3">
                                                    <input type="checkbox" name="addons[]" :value="addon.id" @change="toggleAddon(addon)" class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                                                    <span class="text-gray-700 font-medium" x-text="addon.name"></span>
                                                </div>
                                                <span class="text-gray-500 text-sm" x-text="'+$' + parseFloat(addon.price).toFixed(2)"></span>
                                            </label>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <!-- Footer Actions -->
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <a :href="'https://medaan-middle-eastern-fusion-cuisine.deliverectdirect.com/pickup/medaan-middle-eastern-fusion-cuisine'" 
                                   target="_blank"
                                   class="w-full bg-primary text-white h-12 rounded-xl font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                    <span>Order on Deliverect</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                                <p class="text-center text-[10px] text-gray-400 mt-2 uppercase tracking-widest font-bold">External ordering powered by Deliverect</p>
                            </div>
                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>
</div>
