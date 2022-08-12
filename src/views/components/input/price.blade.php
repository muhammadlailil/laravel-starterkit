<div class="form-group form-show-validation row input_price">
    <label for="{{$name}}" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form">{{$label}}</label>
    <div class="col-lg-8 col-md-9 col-sm-8">
        <input type="number" id="{{$name}}" name="{{$name}}" placeholder="{{(isset($placeholder)?$placeholder:'0')}}" required="required"
            class="form-control" value="{{$slot}}">
            <span class="rp">Rp</span>
    </div>
</div>
