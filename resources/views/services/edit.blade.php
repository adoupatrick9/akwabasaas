    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditService" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form method="post" id="editService" action="">
          @csrf
          @method('put')
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modifier un service</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 form-group">
                   Nom <em class="text-danger">*</em><input type="text" name="sce_nom_service" id="sce_nom_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase">
                </div>
                <div class="col-md-6 form-group">
                    Type <em class="text-danger">*</em><select name="sce_type" id="sce_type" class="form-control placeholder-no-fix">
                        <option value="1">Saas</option>
                        <option value="2">One premise</option>
                    </select>
                </div>
                <div class="col-md-12 text-center text-success chargement">
                    <br>
                    <h6>Veuillez patienter un moment...</h6>
                </div>
            </div>
            <input type="number" class="hidden" id="idas_service">
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
              <button class="btn btn-theme" type="submit">Modifier <i class="fa fa-edit"></i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->

