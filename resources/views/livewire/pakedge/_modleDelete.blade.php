
  <!-- Modal -->
  <div wire:ignore.self class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this package?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          <button wire:click="deletePackage" class="btn bg-gradient-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    Livewire.on('openDeleteModal', () => {
        $('#exampleModal').modal('show');
    });

    Livewire.on('closeDeleteModal', () => {
        $('#exampleModal').modal('hide');
    });
</script>
