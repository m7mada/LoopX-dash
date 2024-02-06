<div class="container-fluid px-5 my-8">
   <div class="card mt-n8">
      <div class="container">
         <div class="row mb-5">
            <div class="col-lg-4 col-md-6 col-7 mx-auto text-center">
               <div class="nav-wrapper mt-5 position-relative z-index-2">
                  <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-pricing" role="tablist">
                    @foreach ($packages->groupBy('type') as $packageCategory )
                        <li class="nav-item">
                            <a class="nav-link mb-0 @once active @endonce" 
                              id="tabs-{{$packageCategory[0]['id']}}" 
                              data-bs-toggle="tab" href="#tabs_{{$packageCategory[0]['id']}}" 
                              role="tab" aria-controls="{{$packageCategory[0]['id']}}" 
                              aria-selected="@if ($loop->first) true @else false @endif">
                              {{$packageCategory[0]['type']}}
                            </a>
                     </li>
                    @endforeach
                  </ul>
               </div>
            </div>
         </div>

         <style>
            .offer{
               padding: 0 10px;
               position: relative;
            }
            .offer small{
               font-size: 12px;
               margin-top: 24px;
               margin-right: -11px;
               display: inline-block;
               opacity: 0.6;
            }
            .offer span.price{
               font-size: 24px;
               opacity: 0.6;
            }
            .offer span:not(.price){
               position: absolute;
               height: 2px;
               background-color: red;
               top: 61%;
               left: 3%;
               width: 100%;
               transform: rotate(351deg)
            }

            .offer-subtitle{
               font-size: 17px;
            }
            .bg-gradient-dark .offer-subtitle{
               color: #fff;
            }
         </style>
         <div class="tab-content tab-space">
            @foreach ($packages->groupBy('type') as $packageCategory )
                <div class="tab-pane @once active @endonce" id="tabs_{{$packageCategory[0]['id']}}">
                    <div class="row">
                        @foreach ( $packageCategory as $package )
                           <div class="col-lg-4 mb-lg-0 mb-4">
                              <div class="card shadow-lg @if ( $loop->index == 1 ) bg-gradient-dark @endif">
                                    <span class="badge rounded-pill @if ( $loop->index == 1 ) bg-primary @else bg-light text-dark @endif  w-30 mt-n2 mx-auto">{{$package->title}}</span>
                                    <div class="card-header text-center pt-4 pb-3 bg-transparent">
                                       <h1 class="font-weight-bold mt-2 @if ( $loop->index == 1 )text-white @endif">

                                       @if ( isset($package->getPrice->packages_prices_discounts->first()->discount) )
                                          <span class="offer">
                                             <small class="align-top">{{$package->getPrice->currency->code ?? '' }}</small>
                                             <span class="price">{{ $package->getPrice->price ?? '' }}</span>
                                             <span></span>
                                          </span>
                                                                              
                                          <small class="text-lg align-top me-1">{{$package->getPrice->currency->code ?? '' }}</small>
                                          <span>
                                             {{$package->getPrice->packages_prices_discounts->first()->discount ?? ''}}
                                          </span>

                                       @else
                                          <small class="text-lg align-top me-1">{{$package->getPrice->currency->code ?? '' }}</small>
                                          <span>
                                             {{ $package->getPrice->price ?? '' }}
                                          </span>
                                       @endif


                                          
                                          
                                       </h1>
                                      
                                    </div>
                                    <div class="card-body text-lg-start text-center pt-0">
                                       {!!$package->description!!}

                                       {{--
                                       @foreach ( $package->benefits as $benefit )
                                          <div class="d-flex justify-content-lg-start justify-content-center p-2">
                                             <i class="material-icons my-auto">done</i>
                                             <span class="ps-3">{{$benefit->getOriginal("pivot_value")}} {{$benefit->name}}</span>
                                          </div>                                         
                                       @endforeach

                                       --}}

                                       <a href="javascript:;" class="btn btn-icon @if ( $loop->index == 1 ) bg-gradient-primary @else bg-gradient-dark @endif d-lg-block mt-3 mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$package->getPrice->id ?? ''}}"> Try Now <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                                       </a>
                                       @include('livewire._model_order')
                                    </div>
                              </div>
                           </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
         </div>
      </div>
      <!-- <div class="row mt-5">
         <div class="col-8 mx-auto text-center">
            <h6 class="opacity-5"> More than 50+ brands trust Material</h6>
         </div>
      </div>
      <div class="row mt-4 mx-5">
         <div class="col-lg-2 col-md-4 col-6 mb-4">
            <img class="w-100 opacity-9" src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/img/logos/gray-logos/logo-coinbase.svg" alt="logo_coinbase">
         </div>
         <div class="col-lg-2 col-md-4 col-6 mb-4">
            <img class="w-100 opacity-9" src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/img/logos/gray-logos/logo-nasa.svg" alt="logo_nasa">
         </div>
         <div class="col-lg-2 col-md-4 col-6 mb-4">
            <img class="w-100 opacity-9" src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/img/logos/gray-logos/logo-netflix.svg" alt="logo_netflix">
         </div>
         <div class="col-lg-2 col-md-4 col-6 mb-4">
            <img class="w-100 opacity-9" src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/img/logos/gray-logos/logo-pinterest.svg" alt="logo_pinterest">
         </div>
         <div class="col-lg-2 col-md-4 col-6 mb-4">
            <img class="w-100 opacity-9" src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/img/logos/gray-logos/logo-spotify.svg" alt="logo_spotify">
         </div>
         <div class="col-lg-2 col-md-4 col-6 mb-4">
            <img class="w-100 opacity-9" src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/img/logos/gray-logos/logo-vodafone.svg" alt="logo_vodafone">
         </div>
      </div> -->
      <div class="row mt-5">
         <div class="col-md-6 mx-auto text-center">
            <h2>Frequently Asked Questions (FAQs):</h2>
            <!-- <p>A lot of people don't appreciate the moment until it’s passed. I'm not trying my hardest,
               and I'm not trying to do 
            </p> -->
         </div>
      </div>
      <div class="row mb-5">
         <div class="col-md-8 mx-auto">
            <div class="accordion" id="accordionRental">
               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingOne">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     What is AI Twin by LoopX?
                     <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                     <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        AI Twin by LoopX is a virtual assistant designed to provide 24/7 personalized customer support and automate business processes.
                     </div>
                  </div>
               </div>
               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingTwo">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     How does AI Twin differ from traditional customer service solutions?
                     <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                     <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        AI Twin offers instant, personalized support in various languages and dialects, handling unlimited clients simultaneously without scaling limitations.
                     </div>
                  </div>
               </div>
               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingThree">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     What languages and dialects can AI Twin support?
                     <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                     <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        AI Twin is proficient in multiple languages and dialects, adapting to users' specific communication styles for seamless interaction.
                     </div>
                  </div>
               </div>
               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingFour">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                     What are the key features of AI Twin?
                     <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                     <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        Key features include 24/7 customer service in brand-specific language and dialect, automated task handling, data-driven insights, and cost-effective scaling.
                     </div>
                  </div>
               </div>
               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingFifth">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                     Can AI Twin handle complex customer queries?
                     <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                     <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseFifth" class="accordion-collapse collapse" aria-labelledby="headingFifth" data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        Yes, AI Twin is designed to resolve inquiries in real-time, providing data-driven insights and proactive suggestions.
                     </div>
                  </div>
               </div>



               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingSixth">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSixth" aria-expanded="false" aria-controls="collapseSixth">
                        Is AI Twin customizable for specific business needs?
                        <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                        <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseSixth" class="accordion-collapse collapse" aria-labelledby="headingSixth"
                     data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        Absolutely, AI Twin can be customized to handle various business functions, from customer inquiries to content creation.
                     </div>
                  </div>
               </div>




               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingSeventh">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeventh" aria-expanded="false" aria-controls="collapseSeventh">
                        What are the pricing plans for AI Twin?
                        <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                        <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseSeventh" class="accordion-collapse collapse" aria-labelledby="headingSeventh"
                     data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        LoopX offers flexible pricing for AI Twin, with different plans suitable for varying business needs.

                     </div>
                  </div>
               </div>



               <div class="accordion-item my-2">
                  <h5 class="accordion-header" id="headingEightth">
                     <button class="accordion-button border-bottom font-weight-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEightth" aria-expanded="false" aria-controls="collapseEightth">
                        How do I set up AI Twin for my business?
                        <i class="collapse-close material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">add</i>
                        <i class="collapse-open material-icons text-sm font-weight-bold pt-1 position-absolute end-0 me-3">remove</i>
                     </button>
                  </h5>
                  <div id="collapseEightth" class="accordion-collapse collapse" aria-labelledby="headingEightth"
                     data-bs-parent="#accordionRental">
                     <div class="accordion-body text-sm opacity-8">
                        Setting up AI Twin is simple and can be done in just a few clicks, with LoopX providing support for data preparation and integration.
               
                     </div>
                  </div>
               </div>


               
            </div>
         </div>
      </div>
   </div>
</div>