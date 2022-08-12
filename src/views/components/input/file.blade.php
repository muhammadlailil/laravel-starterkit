<div class="form-group form-show-validation row">
    <label for="nama" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form" style="margin-top: 25px !important;">
        {{$label}}
    </label>
    <div class="col-lg-8 col-md-9 col-sm-8" style="margin-bottom: -17px !important;">
        <input type="file" id="upload_{{$name}}" name="{{$name}}" accept="image/*" {{($slot)?'':'required'}}
            class="form-control form-control-file"> 
    </div>
   
</div>
