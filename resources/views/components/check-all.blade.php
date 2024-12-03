<input x-data="checkAll" x-ref="checkAllCheckbox" @change="handleChange($event)" type="checkbox">

@script
    <script>
        Alpine.data('checkAll', () => {
            return {
                init() {
                    this.$wire.watch('selectedStudentIds', () => {
                        const allSelected = this.$wire.studentIdsOnPage.every(id => this.$wire.selectedStudentIds.includes(id));
                        const noneSelected = this.$wire.studentIdsOnPage.every(id => !this.$wire.selectedStudentIds.includes(id));

                        if (allSelected) {
                            this.$refs.checkAllCheckbox.checked = true;
                            this.$refs.checkAllCheckbox.indeterminate = false;
                        } else if (noneSelected) {
                            this.$refs.checkAllCheckbox.checked = false;
                            this.$refs.checkAllCheckbox.indeterminate = false;
                        } else {
                            this.$refs.checkAllCheckbox.checked = false;
                            this.$refs.checkAllCheckbox.indeterminate = true;
                        }
                    });
                },
                handleChange(e) {
                    if (e.target.checked) {
                        this.selectAll();
                    } else {
                        this.deselectAll();
                    }
                },
                selectAll() {
                    this.$wire.studentIdsOnPage.forEach(id => {
                        if (!this.$wire.selectedStudentIds.includes(id)) {
                            this.$wire.selectedStudentIds.push(id);
                        }
                    });
                },
                deselectAll() {
                    this.$wire.studentIdsOnPage.forEach(id => {
                        const index = this.$wire.selectedStudentIds.indexOf(id);
                        if (index > -1) {
                            this.$wire.selectedStudentIds.splice(index, 1);
                        }
                    });
                }
            };
        });
    </script>
@endscript
