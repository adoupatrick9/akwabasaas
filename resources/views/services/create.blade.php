<form action="{{ url('/services-create') }}" method="post">
    @csrf
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStore" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Ajouter un service</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 form-group">
                   Nom <em class="text-danger">*</em><input type="text" name="sce_nom_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sce_nom') }}">
                </div>
                <div class="col-md-6 form-group">
                    Type <em class="text-danger">*</em><select name="sce_type" id="sce_type_service" class="form-control placeholder-no-fix">
                        <option value="1">Saas</option>
                        <option value="2">One premise</option>
                    </select>
                </div>
                <div class="col-md-6 container text-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
              <button class="btn btn-theme" type="submit">Enregistrer <i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->
</form>
