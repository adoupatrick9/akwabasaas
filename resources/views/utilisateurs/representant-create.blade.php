<form action="{{ url('/utilisateurs-marquer-interlocuteur-representant/'.$user['ap_matricule_pers']) }}" method="post" style="margin-top: 50px;">
    @csrf
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalStore" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
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
                    <div class="container text-danger col-md-12">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    <div class="modal-footer col-md-12">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Annuler <i class="fa fa-ban"></i></button>
                        <button class="btn btn-theme" type="submit" id="submit">Enregistrer <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->
</form>
