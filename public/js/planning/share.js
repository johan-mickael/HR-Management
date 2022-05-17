document.addEventListener('DOMContentLoaded', function () { 

    const api_users_resources = "http://localhost:8000/plannings/users/json"

    async function getUsers() {
        const response = await fetch(api_users_resources)
        return response.json();
    }

    const users = getUsers();

    $('#shareEventBtn').click((e) => {
        // Getting the current planning ID clicked
        const planningId = $('#eventIdInput').val()

        // Setting the planningId input
        $('#planningIdInput').val(planningId)
        
        // Getting the current planning ID as an object
        var currentPlanning = plannings.filter(p => p.id == planningId)[0]

        // Getting all attendees who participate into the event
        var currentAttendees = currentPlanning.attendees
        console.log(currentAttendees)
    })
})