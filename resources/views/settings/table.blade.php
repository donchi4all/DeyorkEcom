 <table class="table table-striped m-b-none" data-ride="datatables" id="table">
                    <thead>
                        <tr>
                            <th width="">Cart Vat</th>
                            <th width="">Invoice Address</th>
                            <th width="150px">Buttons</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td>{!! $setting->cart_vat !!} %</td>
                                <td>{!! $setting->invoice_address !!}</td>
                                <td>
                                    <a href="{{ route('setting.edit',$setting->id) }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
