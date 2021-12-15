/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

var summaryStatsModal = document.getElementById('summaryStatsModal')

summaryStatsModal.addEventListener('shown.bs.modal', function (event) {
  let button = event.relatedTarget;
  let homeTeamId = button.getAttribute('data-bs-home-team-id')
  let awayTeamId = button.getAttribute('data-bs-away-team-id')

  fetch('/summary-stats?' + new URLSearchParams({
    firstTeamId: homeTeamId,
    secondTeamId: awayTeamId,
  }), {
    method: "GET",
  })
    .then(response => response.text())
    .then(body => {
      summaryStatsModal.getElementsByClassName('modal-body')[0].innerHTML = body
    })
})

summaryStatsModal.addEventListener('hidden.bs.modal', function (event) {
  summaryStatsModal.getElementsByClassName('modal-body')[0].innerHTML = "..."
})

