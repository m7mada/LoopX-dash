<div>
      <!-- Navbar -->
      <!-- End Navbar -->
      <div class="container-fluid py-4">

          <div class="row">

            @if(Auth::user()->is_admin)
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Remaining Customers Wallet</p>
                                <h4 class="mb-0">{{$this->customersRemainingCridets}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> </span>
                                Total Messages </p>
                        </div>
                    </div>

                </div>

                <div class="row"><br></div>

              @endif

              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                      <div class="card-header p-3 pt-2">
                          <div
                              class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                              <i class="material-icons opacity-10">weekend</i>
                          </div>
                          <div class="text-end pt-1">
                              <p class="text-sm mb-0 text-capitalize">Total Replies</p>
                              <h4 class="mb-0">{{$totalUsage}}</h4>
                          </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$lastWeekUsages}} </span>
                              Lask Week</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                      <div class="card-header p-3 pt-2">
                          <div
                              class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                              <i class="material-icons opacity-10">person</i>
                          </div>
                          <div class="text-end pt-1">
                              <p class="text-sm mb-0 text-capitalize">Remaining Balance</p>
                              <h4 class="mb-0">${{ round($this->totalCridets[0]->total_credits - $userTwins->sum("messages_cost"), 2)  }}</h4>
                          </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{count($userOrders)}} </span>Orders</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                      <div class="card-header p-3 pt-2">
                          <div
                              class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                              <i class="material-icons opacity-10">person</i>
                          </div>
                          <div class="text-end pt-1">
                              <p class="text-sm mb-0 text-capitalize">Served Users</p>
                              <h4 class="mb-0">{{$servedUsers}}</h4>
                          </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$servedUsersLastMonth}}</span> Last Week</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                  <div class="card">
                      <div class="card-header p-3 pt-2">
                          <div
                              class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                              <i class="material-icons opacity-10">weekend</i>
                          </div>
                          <div class="text-end pt-1">
                              <p class="text-sm mb-0 text-capitalize">Messages per conversions</p>
                              <h4 class="mb-0">
                                @if($totalUsage)  
                                    {{ round($totalUsage / $totalConversasions) }}
                                @else
                                    0
                                @endif</h4>
                          </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{ $totalConversasions }} </span> Conversions</p>
                      </div>
                  </div>
              </div>
          </div>

            <div class="row mt-4">
                
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex align-items-center">
                            <h6 class="mb-0">Usage Per Twin</h6>
                            <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="See usage per Twin">
                            <i class="fas fa-info" aria-hidden="true"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                            <div class="col-5 text-center">
                                <div class="chart">
                                    <canvas id="twinsUsageChart" class="chart-canvas" height="197" width="287" style="display: block; box-sizing: border-box; height: 197px; width: 287.5px;"></canvas>
                                </div>
                                <h4 class="font-weight-bold mt-n8">
                                    <span>@if($totalUsage) {{$totalUsage}} @else 0 @endif</span>
                                    <span class="d-block text-body text-sm">Reply</span>
                                </h4>
                            </div>
                            <div class="col-7">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0" style="min-height:200px">
                                        <tbody>
                                            @forelse ($userTwins as $twin)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-0">
                                                            <span class="badge me-3" style="background-color:{{$twin->color}}"> </span>
                                                            <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$twin->title}}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs"> {{count($twin->messages->where('role', '=', 'assistant'))}}</span>
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="d-flex px-2 py-0">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><a href="/twins">Try your first Twin -></a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex align-items-center">
                            <h6 class="mb-0">Cost Per Twin</h6>
                            <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="See cost per Twin">
                            <i class="fas fa-info" aria-hidden="true"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                            <div class="col-5 text-center">
                                <div class="chart">
                                    <canvas id="twinsCostChart" class="chart-canvas" height="197" width="287" style="display: block; box-sizing: border-box; height: 197px; width: 287.5px;"></canvas>
                                </div>
                                <h4 class="font-weight-bold mt-n8">
                                    <span>@if($userTwins->sum("messages_cost")) {{ round($userTwins->sum("messages_cost"), 2)}} @else 0 @endif</span>
                                    <span class="d-block text-body text-sm">USD</span>
                                </h4>
                            </div>
                            <div class="col-7">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0" style="min-height:200px">
                                        <tbody>
                                            @forelse ($userTwins as $twin)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-0">
                                                            <span class="badge me-3" style="background-color:{{$twin->color}}"> </span>
                                                            <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$twin->title}}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-xs"> ${{round($twin->messages_cost, 2)}} </span>
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="d-flex px-2 py-0">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><a href="/twins">Try your first Twin -></a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



          {{--<div class="row mt-4">
              <div class="col-lg-4 col-md-6 mt-4 mb-4">
                  <div class="card z-index-2 ">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                              <div class="chart">
                                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <h6 class="mb-0 ">Last Week Messages</h6>
                          <p class="text-sm ">Last Campaign Performance</p>
                          <hr class="dark horizontal">
                          <div class="d-flex ">
                              <i class="material-icons text-sm my-auto me-1">schedule</i>
                              <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mb-4">
                  <div class="card z-index-2  ">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                              <div class="chart">
                                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <h6 class="mb-0 "> Last Month Messages </h6>
                          <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today
                              sales. </p>
                          <hr class="dark horizontal">
                          <div class="d-flex ">
                              <i class="material-icons text-sm my-auto me-1">schedule</i>
                              <p class="mb-0 text-sm"> updated 4 min ago </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 mt-4 mb-3">
                  <div class="card z-index-2 ">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                          <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                              <div class="chart">
                              <!-- <canvas id="line-chart" class="chart-canvas" height="300px"></canvas> -->

                                  <canvas id="line-chart" class="chart-canvas" height="170"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <h6 class="mb-0 ">Twins usage</h6>
                          <p class="text-sm ">Last Campaign Performance</p>
                          <hr class="dark horizontal">
                          <div class="d-flex ">
                              <i class="material-icons text-sm my-auto me-1">schedule</i>
                              <p class="mb-0 text-sm">just updated</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>--}}
          <div class="row mt-4">
              <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                  <div class="card">
                      <div class="card-header pb-0">
                          <div class="row">
                              <div class="col-lg-6 col-7">
                                  <h6>Twins Usage</h6>
                                  <!-- <p class="text-sm mb-0">
                                      <i class="fa fa-check text-info" aria-hidden="true"></i>
                                      <span class="font-weight-bold ms-1">30 done</span> this month
                                  </p> -->
                              </div>
                              <div class="col-lg-6 col-5 my-auto text-end">
                                  <div class="dropdown float-lg-end pe-4">
                                      <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                          aria-expanded="false">
                                          <i class="fa fa-ellipsis-v text-secondary"></i>
                                      </a>
                                      <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                          aria-labelledby="dropdownTable">
                                          <li><a class="dropdown-item border-radius-md" href="/twins">Edit Twins</a>
                                          </li>
                                          <li><a class="dropdown-item border-radius-md" href="/billing">Billing
                                                  </a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-body px-0 pb-2">
                          <div class="table-responsive">
                              <table class="table-list table align-items-center mb-0">
                                  <thead>
                                      <tr>
                                          <th
                                              class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                              Twins</th>
                                          <!-- <th
                                              class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                              Knolag files</th> -->
                                          <th
                                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                              Knowledge files</th>
                                          <th
                                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                              Messages</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                     @forelse ($userTwins as $twin)

                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                    

                                                            <img src="{{ asset('assets') }}/img/favicon.png" class="avatar avatar-sm rounded-circle me-2" alt="Twin">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{$twin->title}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <div class="avatar-group mt-2">
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Romina Hadid">
                                                        <img src="{{ asset('assets') }}/img/team-2.jpg" alt="team5">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Jessica Doe">
                                                        <img src="{{ asset('assets') }}/img/team-4.jpg" alt="team6">
                                                    </a>
                                                </div>
                                            </td> -->
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> {{count($twin->files)}} Files</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs font-weight-bold">{{count($twin->messages->where('role', '=', 'assistant'))}} Reply</span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="progress">
                                                        <div class="progress-bar bg-gradient-info w-10"
                                                            role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div> -->
                                                </div>
                                            </td>
                                        </tr>
                                      @empty
                                        <tr>
                                            <td colspan="3" class="align-middle text-center text-sm">
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><a href="/twins">Try your first Twin -></a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>   
                                     @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="card h-100">
                      <div class="card-header pb-0">
                          <h6>Order Overview</h6>
                          <p class="text-sm">
                              <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                              <span class="font-weight-bold">{{$userOrders->where('created_at', '>', \Carbon\Carbon::now()->subMonth()->startOfWeek())->count()}}</span> This Month
                          </p>
                      </div>
                      <div class="card-body p-3">
                          <div class="timeline timeline-one-side">

                                @forelse ($userOrders as $order)
                                    <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="material-icons text-success text-gradient">shopping_cart</i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">{{$order->net_paid}} £  By Order  {{$order->serial_number}} </h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$order->created_at}}
                                        </p>
                                    </div>
                                    </div>
                                @empty
                                    
                                @endforelse
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  @push('js')
  <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
  <script>
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
          type: "bar",
          data: {
              labels: ["M", "T", "W", "T", "F", "S", "S"],
              datasets: [{
                  label: "Sales",
                  tension: 0.4,
                  borderWidth: 0,
                  borderRadius: 4,
                  borderSkipped: false,
                  backgroundColor: "rgba(255, 255, 255, .8)",
                  data: [50, 20, 10, 22, 50, 10, 40],
                  maxBarThickness: 6
              }, ],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          suggestedMin: 0,
                          suggestedMax: 500,
                          beginAtZero: true,
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                          color: "#fff"
                      },
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      new Chart(ctx2, {
          type: "line",
          data: {
              labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              datasets: [{
                  label: "Mobile apps",
                  tension: 0,
                  borderWidth: 0,
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(255, 255, 255, .8)",
                  pointBorderColor: "transparent",
                  borderColor: "rgba(255, 255, 255, .8)",
                  borderColor: "rgba(255, 255, 255, .8)",
                  borderWidth: 4,
                  backgroundColor: "transparent",
                  fill: true,
                  data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                  maxBarThickness: 6

              }],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: false,
                          drawOnChartArea: false,
                          drawTicks: false,
                          borderDash: [5, 5]
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });

      var ctx3 = document.getElementById("line-chart").getContext("2d");

      new Chart(ctx3, {
          type: "line",
          data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Organic Search",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 2,
              pointBackgroundColor: "#e3316e",
              borderColor: "#e3316e",
              borderWidth: 3,
              backgroundColor: 'transparent',
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6
            },
            {
              label: "Referral",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 2,
              pointBackgroundColor: "#3A416F",
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: 'transparent',
              data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
              maxBarThickness: 6
            },
            {
              label: "Direct",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 2,
              pointBackgroundColor: "#17c1e8",
              borderColor: "#17c1e8",
              borderWidth: 3,
              backgroundColor: 'transparent',
              data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
              maxBarThickness: 6
            },
          ],
        },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          padding: 10,
                          color: '#f8f9fa',
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: false,
                          drawOnChartArea: false,
                          drawTicks: false,
                          borderDash: [5, 5]
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });

  </script>








<script src="https://material-dashboard-pro-laravel-livewire.creative-tim.com/assets/js/plugins/round-slider.min.js"></script>
<script>





        // Chart Doughnut Consumption by room
        var ctx1 = document.getElementById("twinsUsageChart").getContext("2d");


        // Twins usage chart
        new Chart(ctx1, {
            type: "doughnut",
            data: {
                labels: @json($userTwins->pluck('title')),
                datasets: [{
                    weight: 9,
                    cutout: 90,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: @json($userTwins->pluck('color')),
                    data: @json($userTwins->pluck('messages_count')),
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });



        // Chart Doughnut Consumption by room
        var ctx2 = document.getElementById("twinsCostChart").getContext("2d");


        // Twins usage chart
        new Chart(ctx2, {
            type: "doughnut",
            data: {
                labels: @json($userTwins->pluck('title')),
                datasets: [{
                    weight: 9,
                    cutout: 90,
                    tension: 0.9,
                    pointRadius: 2,
                    borderWidth: 2,
                    backgroundColor: @json($userTwins->pluck('color')),
                    data: @json($userTwins->pluck('messages_cost')),
                    fill: false
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false,
                        }
                    },
                },
            },
        });



    </script>
  @endpush
