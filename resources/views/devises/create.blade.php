  <!-- Modal -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStoreDevise" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
            <form id="storeDevise">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ajouter une devise</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12 form-group">
                        Devise <em class="text-danger">*</em><input type="text" name="dev_intitule_devise" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('dev_intitule_devise') }}">
                    </div>
                    <div class="col-md-12 container" id="msg"></div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
                    <button class="btn btn-theme" type="submit">Enregistrer <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
      </div>
    </div>
    <!-- modal -->


