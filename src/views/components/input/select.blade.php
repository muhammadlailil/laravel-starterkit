<div class="form-group form-show-validation row">
    <label for="{{$name}}" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form">{{$label}}</label>
    <div class="col-lg-8 col-md-9 col-sm-8">
        <select id="{{$name}}" name="{{$name}}" placeholder="{{(isset($placeholder)?$placeholder:$label)}}"
            required class="form-control {{(isset($class)?$class:'')}}">
            {{$slot}}
        </select>
    </div>
</div>
