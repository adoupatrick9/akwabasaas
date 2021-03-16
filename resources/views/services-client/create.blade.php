<form action="{{ url('/services-client-create/'.$IDclient) }}" method="post">
    @csrf
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStore" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Ajouter un service au client</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-8 form-group">
                    Service <em class="text-danger">*</em><select name="Sce_code_service" id="Sce_code_service" class="form-control placeholder-no-fix">
                        @foreach($services as $service)
                            <option value="{{ $service['sce_code_service'] }}">{{ $service['sce_nom_service'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    Périodicité <em class="text-danger">*</em><select name="sc_periodicite" id="sc_periodicite" class="form-control placeholder-no-fix">
                        <option value="1">Mensuelle</option>
                        <option value="2">Trimestrielle</option>
                        <option value="2">Semestrielle</option>
                        <option value="2">Annuel</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                   Début service <em class="text-danger">*</em><input type="date" name="sc_debut_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_debut_service') }}">
                </div>
                <div class="col-md-4 form-group">
                   Fin service <em class="text-danger">*</em><input type="date" name="sc_fin_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_fin_service') }}">
                </div>
                <div class="col-md-4 form-group">
                   Date souscription <em class="text-danger">*</em><input type="date" name="sc_date_souscription" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_date_souscription') }}">
                </div>
                <div class="col-md-4 form-group">
                   Début souscription <em class="text-danger">*</em><input type="date" name="sc_debut_souscription" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_debut_souscription') }}">
                </div>
                <div class="col-md-4 form-group">
                   Fin souscription <em class="text-danger">*</em><input type="date" name="sc_fin_souscription" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_fin_souscription') }}">
                </div>
                <div class="col-md-4 form-group">
                    Option facturation <em class="text-danger">*</em><select name="sc_option_facturation" id="sc_option_facturation" class="form-control placeholder-no-fix">
                        <option value="1">Mensuelle</option>
                        <option value="2">Trimestrielle</option>
                        <option value="2">Semestrielle</option>
                        <option value="2">Annuel</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                   Quantité<em class="text-danger">*</em><input type="number" name="sc_quantite" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_quantite') }}">
                </div>
                <div class="col-md-4 form-group">
                   Coût service<em class="text-danger">*</em><input type="number" name="sc_cout_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('sc_cout_service') }}">
                </div>
                <div class="col-md-4 form-group">
                   Clé physique<em class="text-danger">*</em><input type="text" name="Sc_licence_cle_physique" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('Sc_licence_cle_physique') }}">
                </div>
                <div class="col-md-4 form-group">
                   Clé fournie<em class="text-danger">*</em><input type="text" name="Sc_licence_cle_fourni" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('Sc_licence_cle_fourni') }}">
                </div>
                <div class="col-md-4 form-group">
                   Nombre<em class="text-danger">*</em><input type="number" name="Sc_licence_nombre" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('Sc_licence_nombre') }}">
                </div>
                <div class="col-md-4 form-group">
                   Remise<em class="text-danger">*</em><input type="number" name="Sc_montant_remise" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ old('Sc_montant_remise') }}">
                </div>
                <div class="col-md-4 form-group">
                   Modalité de paiement<em class="text-danger">*</em><select name="Sce_modalitepaiement" id="Sce_modalitepaiement" class="form-control placeholder-no-fix">
                        <option value="1">Mensuelle</option>
                        <option value="2">Trimestrielle</option>
                        <option value="2">Semestrielle</option>
                        <option value="2">Annuel</option>
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
