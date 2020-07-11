<div class="modal-header">
    <h5 class="modal-title" id="title">POST NEW BLOG</h5>
    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
    </button>
</div>
<form action="{{URL::to('save_blogs')}}" method="post" class="needs-validation" enctype="multipart/form-data">
    @csrf
    <div class="modal-body" style="max-height: 450px;overflow: auto;">
        <div class="card-body">

            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">Title*</label>
                    <input class="form-control" id="title" name="title" type="text" placeholder="Enter Title"
                           required
                           data-original-title="" title="">
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">Image*</label>
                    <input class="form-control" id="image" name="image" type="file" required data-original-title=""
                           accept="image/*"
                           title="">
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">Description*</label>
                    <textarea class="form-control" id="description" name="description" type="text"
                              placeholder="Enter Description"
                              required
                              data-original-title="" title="" cols="30" rows="5"></textarea>
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">Categories*(use ctrl for multiple selection)</label>
                    <select name="categories[]" multiple id="" required class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">Created By</label>
                    <input class="form-control" id="created_by" name="created_by" type="hidden" required=""
                           data-original-title="" title="" value="{{$user->id}}">
                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Name" required=""
                           data-original-title="" title="" readonly value="{{$user->name}}">
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
