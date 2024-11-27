<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list" style="padding-top: 0px!important">
    <div class="card border">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label>Site name</label>
                    <input type="text" class="form-control" data-tribute="true" name="site_name" value="">
                </div>
                <div class="form-group">
                    <label>Site name</label>
                    <select name="layout" id="" class="form-control">
                        <option value="LTR">LTR</option>
                        <option value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" class="form-control" data-tribute="true" name="email" value="">
                </div>
                <div class="form-group">
                    <label>Default Currency</label>
                    <select name="default_currency" id="" class="form-control">
                        <option value="LTR">LTR</option>
                        <option value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" class="form-control" data-tribute="true" name="currency_icon" value="">
                </div>
                <div class="form-group">
                    <label>Time Zone</label>
                    <input type="text" class="form-control" data-tribute="true" name="time_zone" value="">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
