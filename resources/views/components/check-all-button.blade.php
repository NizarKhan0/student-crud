<div x-data="checkAllButton">
    <button @click="selectAll"
        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-yellow-500 rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        <i class="mr-2 fas fa-arrow-down"></i> Select All ?
    </button>
</div>

@script
    <script>
        Alpine.data('checkAllButton', () => {
            return {
                allSelected: false,
                selectAll() {
                    // console.log('test');
                    if (this.$wire.selectedStudentIds === this.$wire.allStudentIds) {
                        this.deSelectAll();
                        return;
                    }
                    this.$wire.selectedStudentIds = this.$wire.allStudentIds;
                    this.allSelected = true;
                },
                deSelectAll() {
                    this.$wire.selectedStudentIds = [];
                    this.allSelected = false;
                }
            };
        });
    </script>
@endscript
