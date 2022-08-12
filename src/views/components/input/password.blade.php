<div class="form-group form-show-validation row">
    <label for="{{$name}}" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form">{{$label}}</label>
    <div class="col-lg-8 col-md-9 col-sm-8">
        <input type="password" id="{{$name}}" name="{{$name}}" placeholder="{{(isset($placeholder)?$placeholder:$label)}}" {{($slot!='')?'':'required'}}
            class="form-control" value="">
            @if($slot!='')
            <span class="help-text">Biarkan kosong jika tidak ingin mengubah password</span>
            @endif
    </div>
</div>
