
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStoreRepresentant" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="addRepresentant">
                @csrf
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ajouter un representant</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <div class="col-md-12 form-group">
                            Interlocuteur disponible<span class="text-danger">*</span><select name="ap_matricule_pers" id="ap_matricule_pers" class="form-control">
                                <option value="">Choisir ...</option>
                                @foreach($interlocuteurs as $interlocuteur)
                                    <option value="{{ $interlocuteur['ap_matricule_pers'] }}">{{ $interlocuteur['NomComplet'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" id="matricule" class="hidden" value="{{ $user['ap_matricule_pers'] }}">
                        <input type="text" id="IDpartenaire" class="hidden" value="{{ $user['IDas_personne'] }}">
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

