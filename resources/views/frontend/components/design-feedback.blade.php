<div class="md:grid md:grid-col-12 md:gap-2 p-4">
    <div class="mt-5 md:mt-0 md:col-span-10" wire:ignore>
        <div class="px-4 sm:px-0" x-data="{
            notes: @entangle('notes'),
            syncNotes() {
                jQuery(this.$refs.image)
                    .imgNotes('clear')
                    .imgNotes('import', this.notes);
            },
            intializeMarkers() {
                let self = this;

                jQuery(this.$refs.image).imgNotes({
                    canEdit: true,
                    onEdit: function(ev, elem) {
                        self.notes = this.notes.map(point => jQuery(point).data('note'));
        
                        let note = jQuery(elem).data('note');
                        note.id && $wire.emit('setFeedback', note);
                    }
                });
        
                this.$watch('notes', () => this.syncNotes());
                this.syncNotes();

            }
        }" x-init="intializeMarkers">
            <img x-ref="image" src="{{ $revision->getFirstMediaUrl('images') }}" @load="syncNotes"
                class="shadow-xl cursor-crosshair z-0 overflow-hidden" width="100%" />
        </div>
    </div>

    <x-full-page-loader wire:loading />

</div>
