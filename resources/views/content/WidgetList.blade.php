<x-layout titlePage="Apps" bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar bar activePage='content.view'></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Apps" index='<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/content">Content types</a></li>'></x-navbars.navs.auth>
      
 

       

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2" style="min-height: 77vh;">
                            <div class="div-header bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-white mx-3"><strong>Apps</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="me-3 my-3">
                                <div class="text-end">
                                  
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('content.view') }}">
                                        <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back
                                    </a>
                                </div>
                                <div class="card-body text-center row justify-content-evenly">
                                        @foreach ($applist as $applist)
                                            
                                            <div class="card" style="width: 18rem;">
                                                <img src="{{ asset('contents/clock/'.$applist->image.'.png') }}" class="card-img-top" alt="Digital Clock">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$applist->formatted_name}}</h5>
                                                    <button data-url="{{$applist->content}}" class="btn btn-primary apps">View</buton>
                                                </div>
                                            </div>
                                
                                       
                                
                                        @endforeach
                                      
                                
                                            <div class="card" style="width: 18rem;">
                                                <img src="{{ asset('contents/clock/banner0.png') }}" class="card-img-top" alt="Banner">
                                                <div class="card-body">
                                                    <h5 class="card-title">Banner</h5>
                                                    <a href="/content-banner-list" class="btn btn-primary">View</a>
                                                </div>
                                            </div>
                                
                                    
                                        
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>






    </main>
    <x-plugins></x-plugins>
    <!-- Modal Structure -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">App View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">
                <!-- Iframe to load the content URL -->
                <iframe id="appIframe" src="" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

    @push('js')
   
    <script>
        $(document).ready(function() {
            // When the "View" button is clicked
            $('.apps').on('click', function() {
                // Get the URL from the data-url attribute of the clicked button
                var url = $(this).data('url');
                
                // Set the iframe src to the clicked URL
                $('#appIframe').attr('src', url);
                
                // Show the modal
                $('#viewModal').modal('show');
            });
        });
    </script>

    @endpush
</x-layout>
