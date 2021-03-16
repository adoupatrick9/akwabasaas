    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEditPartenaire" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <form id="editPartenaire">
            @csrf
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modifier un partenaire</h4>
            </div>
            <div class="modal-body row">
                <div class="container col-md-12">
                    <div class="col-md-6 form-group">
                        Type personne<span class="text-danger">*</span><select name="ap_type_pers" id="ap_type" class="form-control">
                            <option value="1">Personne Physique</option>
                            <option value="2">Personne Morale</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        Nom <span class="text-danger">*</span><input type="text" name="ap_nom_pers" id="ap_nom_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_nom_pers') }}">
                    </div>
                    <div class="col-md-12 form-group genreE">
                        Prénoms <span class="text-danger">*</span><input type="text" name="ap_prenom_pers" id="ap_prenom_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_prenom_pers') }}">
                    </div>
                </div>
                <div class="tabs">
                    <ul class="tabs__items">
                        <li class="tabs__item tabs_active" style="font-weight: bold;">Informations personnelles</li>
                        <li class="tabs__item" data-hash="#ill" style="font-weight: bold;">Coordonnées</li>
                    </ul>
                    <div class="tabs__content-wrapper">
                        <div class="tabs__content tabs_active">
                            <div class="col-md-6 form-group genreE">
                                Genre <span class="text-danger">*</span><select name="ap_genre_pers" id="ap_genre" class="form-control">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                Date de naissance<input type="date" name="ap_datenais_pers" id="ap_datenais_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_datenais_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Lieu de naissance<input type="text" name="ap_lieunai_pers" id="ap_lieunai_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_lieunai_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Type de pièce<input type="text" name="ap_typepiece_pers" id="ap_typepiece_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_typepiece_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Numéro pièce <input type="text" name="ap_numeropiece_pers" id="ap_numeropiece_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_numeropiece_pers') }}">
                            </div>
                        </div>
                        <div class="tabs__content" >
                            <div class="col-md-6 form-group">
                                Téléphone mobile <span class="text-danger">*</span><input type="phone" name="ap_mobile_pers"  id="ap_mobile_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_mobile_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Téléphone fixe<input type="phone" name="ap_telephone_pers" id="ap_telephone_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_telephone_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Email <span class="text-danger">*</span><input type="email" name="ap_email_pers" id="ap_email_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_email_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Pays <span class="text-danger">*</span><select name="ap_pays_pers" id="ap_pays" class="form-control">
                                    @foreach($pays as $pays)
                                        <option value="{{ $pays['LeNomPays'] }}">{{ $pays['LeNomPays'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                Ville <span class="text-danger">*</span><input type="text" name="ap_ville_pers" id="ap_ville_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_ville_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Site web<input type="text" name="ap_siteweb_pers" id="ap_siteweb_pers"  autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_siteweb_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Adresse postale<input type="text" name="ap_adressepostale_pers" id="ap_adressepostale_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_adressepostale_pers') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                Adresse géographique<input type="text" name="ap_adressegeo_pers" id="ap_adressegeo_pers" autocomplete="on" class="form-control placeholder-no-fix" value="{{ old('ap_adressegeo_pers') }}">
                            </div>
                            <input type="number" class="hidden" id="IDas_personne">
                            </form>
                        </div>
                        <div class="tabs__content">
                        </div>
                        <div class="col-md-12 text-center text-success chargement">
                            <br>
                            <h6>Veuillez patienter un moment...</h6>
                        </div>
                        <div class="modal-footer col-md-12">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
                            <button class="btn btn-theme" type="submit" id="submit">Modifier <i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->


