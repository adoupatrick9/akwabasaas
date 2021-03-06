<form action="{{ url('/services-client-affecter/'.$IDclient) }}" method="post">
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
                <div class="col-md-12 form-group">
                    Service <em class="text-danger">*</em><select name="Sce_code_service" id="Sce_code_service" class="form-control placeholder-no-fix">
                        @foreach($services as $service)
                            <option value="{{ $service['sce_code_service'] }}">{{ $service['Sce_nom_service'] }}</option>
                        @endforeach
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
