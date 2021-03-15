  <!-- Modal -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditDevise" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <form id="EditDevise" method="post" action="">
          @csrf
          @method('put')
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Modifier une devise</h4>
              </div>
              <div class="modal-body row">
                  <div class="col-md-12 form-group">
                      Devise <em class="text-danger">*</em><input type="text" name="Dev_intitule_devise" id="Dev_intitule_devise" autocomplete="on" class="form-control placeholder-no-fix text-uppercase">
                  </div>
                  <div class="col-md-12 container" id="msg"></div>
              </div>
              <input type="number" class="hidden" id="IDas_devise">
              <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
                  <button class="btn btn-theme" type="submit">Modifier <i class="fa fa-edit"></i></button>
              </div>
          </form>
      </div>
    </div>
  </div>
  <!-- modal -->



