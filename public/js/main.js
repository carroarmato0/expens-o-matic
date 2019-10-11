const expenses = document.getElementById('expenses');

if (expenses) {
  expenses.addEventListener('click', e => {
    if ( $(e.target).hasClass('delete-expense')) {
      if (confirm('Are you sure?')) {
        const id = e.target.getAttribute('data-id');

        fetch("/expense/" + id + "/delete", {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  })
}