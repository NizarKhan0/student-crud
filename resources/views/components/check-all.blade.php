<input x-data="checkAll" @change="handleChange($event)" type="checkbox">

@script
  <script>
    Alpine.data('checkAll', () => {
      return {
        handleChange(e) {
          if (e.target.checked) {
            this.selectAll();
          } else {
            this.deselectAll();
          }
        },
        selectAll() {
          this.$wire.studentIdsOnPage.forEach(id => {
            if (this.$wire.selectedStudentIds.includes(id)) return;
              this.$wire.selectedStudentIds.push(id);
          });
        },
        deselectAll() {
          this.$wire.selectedStudentIds = [];
        }
      };
    });
  </script>
@endscript
