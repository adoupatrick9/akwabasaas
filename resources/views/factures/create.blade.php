    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStoreFacture" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="addFacture">
            @csrf
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Nouvelle facture</h4>
            </div>
            <div class="modal-body row">
                <div class="container col-md-12">
                    <div class="col-md-6 form-group">
                        Montant total<span class="text-danger">*</span><input type="number" name="Fac_montant" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_nom_pers') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Montant réglé <span class="text-danger">*</span><input type="nomber" name="Fac_montant_paye" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_prenom_pers') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Date facturation <span class="text-danger">*</span><input type="date" name="Fac_date_facturation" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_login_pers') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Date échéance <span class="text-danger">*</span><input type="date" name="Fac_date_echeance" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_login_pers') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Début période<span class="text-danger">*</span><input type="date" name="Fac_debut_periode" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_login_pers') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Fin période <span class="text-danger">*</span><input type="date" name="Fac_fin_periode" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_login_pers') }}">
                    </div>
                    <div class="modal-footer col-md-12">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
                          <button class="btn btn-theme" type="submit" id="submit">Enregistrer <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <!-- modal -->


