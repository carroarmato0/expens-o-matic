const expenses = document.getElementById('expenses');

if (expenses) {
  expenses.addEventListener('click', e => {
    if (e.target.className === 'btn btn-primary btn-sm delete-expense') {
      if (confirm('Are you sure?')) {
        const id = e.target.getAttribute('data-id');

        //fetch("/expense/${id}/delete", {
        //  method: 'DELETE'
        //}).then(res => window.location.reload());

        fetch("/expense/" + id + "/delete", {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  })
}