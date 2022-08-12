<div class="form-group form-show-validation row">
    <label for="nama" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form" style="margin-top: 25px !important;">
        {{$label}}
    </label>
    <div class="col-lg-8 col-md-9 col-sm-8" style="margin-bottom: -17px !important;">
        <div class="input-file input-file-image">
            <img width="70" height="70" src="{{($value)?$value:'https://ui-avatars.com/api/?name=PAR&color=7F9CF5&background=EBF4FF&size=12'}}" alt="preview"
                class="img-upload-preview img-circle pull-left">
            <input type="file" id="upload_{{$name}}" name="{{$name}}" accept="image/*" {{($value)?'':'required'}}
                class="form-control form-control-file">
            <label for="upload_{{$name}}" class="btn-browse-file btn-browse-file-c label-input-file btn btn-black">
                Browse
            </label>
        </div>
    </div>
   
</div>
