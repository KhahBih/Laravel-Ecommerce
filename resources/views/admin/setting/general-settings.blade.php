<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list" style="padding-top: 0px!important">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.settings.update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site name</label>
                    <input type="text" class="form-control" data-tribute="true" name="site_name" value="{{$generalSettings->site_name}}">
                </div>
                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" id="" class="form-control">
                        <option value="">Select</option>
                        <option {{@$generalSettings->layout == 'LTR' ? 'selected' : ''}} value="LTR">LTR</option>
                        <option {{@$generalSettings->layout == 'RTL' ? 'selected' : ''}} value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" class="form-control" data-tribute="true" name="email" value="{{@$generalSettings->contact_email}}">
                </div>
                <div class="form-group">
                    <label>Default Currency</label>
                    <select name="default_currency" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.currency_list') as $currency)
                            <option {{@$generalSettings->default_currency_name == $currency ? 'selected' : ''}}
                            value="{{$currency}}">{{$currency}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" class="form-control" data-tribute="true" name="currency_icon" value="{{@$generalSettings->currency_icon}}">
                </div>
                <div class="form-group">
                    <label>Time Zone</label>
                    <select name="time_zone" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.time_zone') as $key => $time_zone)
                            <option {{@$generalSettings->time_zone == $key ? 'selected' : ''}} value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
