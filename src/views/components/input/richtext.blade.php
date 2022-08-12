<div class="form-group form-show-validation row">
    <label for="{{$name}}" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form">{{$label}}</label>
    <div class="col-lg-8 col-md-9 col-sm-8">
        <textarea id="{{$name}}" name="{{$name}}" cols="30" rows="4"
            placeholder="{{(isset($placeholder)?$placeholder:$label)}}" required="required"
            class="form-control richtextEditor">{{($slot!='')?$slot:old($name)}}</textarea>
    </div>
</div>