<!-- @if (session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(()=> show = false, 2000)" x-show="show" class="fixed top-0 left-1/2 -translate-x-1/2 bg-white  text-dark px-40 py-3">
   <p>
      {{session('message')}}
   </p>
</div>
@endif -->
@if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="fixed  z-10 top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 overflow-y-auto ">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 ">
            
            <div x-show="show" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                
                    <div class="sm:flex sm:items-start">
                        
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            
                            <div class="m-2 p-4">
                                <p class="text-sm text-gray-500">
                                    {{ session('message') }}
                                </p>
                            </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endif
