
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStoreService" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="addService" action="{{ url("/services-create") }}"
          @csrf
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
                <div class="col-md-12 text-center text-success chargement">
                    <br>
                    <h6>Veuillez patienter un moment...</h6>
                </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
              <button type="submit" class="btn btn-theme" >Enregistrer <i class="fa fa-save"></i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->

