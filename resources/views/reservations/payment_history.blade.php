@if(count($myPayments)> 0)
<!-- Start payment history -->
<div class="card card-primary card-outline direct-chat direct-chat-primary">
            <div class="card-header">
              <h3 class="card-title">Payment History</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Balance</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myPayments as $p)
                    <tr class="{{$p->amount>0?'table-success': 'table-danger'}}">
                      <td>{{date('M d, Y h:i:s a', strtotime($p->added_on))}}</td>
                      <td>{{number_format($p->amount, 2, '.', ',')}}</td>
                      <td>{{number_format($p->balance, 2, '.', ',')}}</td>
                      <td>{{$p->amount>0?'Paid': 'Refunded'}}</td>
                    </tr>
                    @endforeach
                   
                  </tbody>
                </table>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- End payment -->
@endif           