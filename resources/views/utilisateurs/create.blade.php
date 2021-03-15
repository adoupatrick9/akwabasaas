<form action="{{ url('/utilisateurs-create/utilisateur') }}" method="post" id="NewUser">
    @csrf
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStore" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Ajouter un utilisateur</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-4 form-group">
                    Nom <span class="text-danger">*</span><input type="text" name="ap_nom_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_nom_pers') }}">
                </div>
                <div class="col-md-5 form-group">
                    Prénoms <input type="text" name="ap_prenom_pers"  autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_prenom_pers') }}">
                </div>
                <div class="col-md-3 form-group">
                    Login <span class="text-danger">*</span><input type="text" name="ap_login_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_login_pers') }}">
                </div>
                <div class="tabs">
                    <ul class="tabs__items">
                        <li class="tabs__item tabs_active">Informations personnelles</li>
                        <li class="tabs__item" data-hash="#ill">Coordonnées</li>
                    </ul>
                    <div class="tabs__content-wrapper">
                        <div class="tabs__content tabs_active">
                            <div class="col-md-3 form-group">
                                Type personne<span class="text-danger">*</span><select name="ap_type_pers" id="ap_type_pers" class="form-control">
                                    <option value="1">Physique</option>
                                    <option value="2">Morale</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                Genre <span class="text-danger">*</span><select name="ap_genre_pers" id="ap_genre_pers" class="form-control">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                Date de naissance<input type="date" name="ap_datenais_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_datenais_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Lieu de naissance<input type="text" name="ap_lieunai_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_lieunai_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Type pièce <select name="ap_typepiece_pers" id="ap_typepiece_pers" class="form-control">
                                    <option value="Carte nationale d'identité">Carte nationale d'identité</option>
                                    <option value="Passeport">Passeport</option>
                                    <option value="Permis de conduire">Permis de conduire</option>
                                    <option value="Carte de résident">Carte de résident</option>
                                    <option value="Carte de séjour">Carte de séjour</option>
                                    <option value="registre de commerce des sociétés">registre de commerce des sociétés</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                Numéro pièce <input type="text" name="ap_numeropiece_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_numeropiece_pers') }}">
                            </div>
                        </div>
                        <div class="tabs__content" >
                            <div class="col-md-6 form-group">
                                Téléphone mobile <span class="text-danger">*</span><input type="phone" name="ap_mobile_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_mobile_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Téléphone fix<input type="phone" name="ap_telephone_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_telephone_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Email <span class="text-danger">*</span><input type="email" name="ap_email_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_email_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Pays <span class="text-danger">*</span><select name="ap_pays_pers" id="ap_pays_pers" class="form-control">
                                    @foreach($pays as $pays)
                                        <option value="{{ $pays['LeNomPays'] }}">{{ $pays['LeNomPays'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                Ville <span class="text-danger">*</span><input type="text" name="ap_ville_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_ville_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Site web<input type="text" name="ap_siteweb_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_siteweb_pers') }}">
                            </div>
                            <div class="modal-footer col-md-12">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
                                <button class="btn btn-theme" type="submit" id="submit">Enregistrer <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="tabs__content">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->
</form>
