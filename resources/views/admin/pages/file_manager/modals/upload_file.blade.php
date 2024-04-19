<div class="modal" id="uploadModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="fileManagerUpload" action="{{ route('admin.system.file_manager.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="max-height: 500px; overflow: auto;">
                        <div class="form-group mb-3">
                            <label for="modalFolder">{{trans('admin.page.file_manager.content.folder')}}</label>
                            <input id="modalFolder" type="text" name="folder" value="{{ request('folder', '/') }}"  class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="modalFileName">{{trans('admin.page.file_manager.content.file_name')}}</label>
                            <input id="modalFileName" type="text" name="file_name" value=""  class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="modalFile">{{trans('admin.page.file_manager.content.file')}}</label>
                            <input id="modalFile" type="file" name="file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">{{trans('admin.button.cancel')}}</button>
                    <button type="button" onclick="submitForm(); return"  class="btn btn-primary">{{trans('admin.button.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function submitForm() {

        let modalFolder = document.getElementById("modalFolder");
        let modalFile = document.getElementById("modalFile");

        if (modalFolder.value === ""  || modalFile.value === "") {
            alert("Ensure you input a value in all fields!");
        } else {
            document.getElementById("fileManagerUpload").submit();
        }

        return false;
   }
</script>




