<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list" style="padding-top: 0px!important">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.settings.update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Paypal Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Select</option>
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" id="" class="form-control">
                        <option value="">Select</option>
                        <option value="1">Live</option>
                        <option value="0">Sandbox</option>
                    </select>
                </div>
                <input type="hidden" value="VN" name="country_name">
                <input type="hidden" value="VND" name="currency_name">
                {{-- <div class="form-group">
                    <label>Currency rate ( per USD )</label>
                    <input type="text" class="form-control" data-tribute="true" name="currency_rate" value="">
                </div> --}}
                <div class="form-group">
                    <label>Paypal Client ID</label>
                    <input type="text" class="form-control" data-tribute="true" name="client_id" value="">
                </div>
                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input type="text" class="form-control" data-tribute="true" name="secret_key" value="">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
