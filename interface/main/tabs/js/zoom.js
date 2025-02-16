async function joinMeeting(meetDetails, patientData) {
    try {
        const thing = `/bsemr/interface/zoom/index.html?meetingId=${meetDetails.meeting_id}&meetingPwd=${meetDetails.password}&meetingRole=1&displayName=${patientData.fname || ''} ${patientData.lname || ''}&meetingEmail=${`yuvrajsingh08cs@gmail.com`}`;
        console.log("This is the thing: ", thing);
        parent.navigateTab(`/bsemr/interface/zoom/index.html?meetingId=${meetDetails.meeting_id}&meetingPwd=${meetDetails.password}&meetingRole=1&displayName=${patientData.fname || ''} ${patientData.lname || ''}&meetingEmail=${`yuvrajsingh08cs@gmail.com`}`, 'meet');
        parent.navigateTab(`/bsemr/interface/zoom/index.html?meetingId=${meetDetails.meeting_id}&meetingPwd=${meetDetails.password}&meetingRole=1&displayName=${patientData.fname || ''} ${patientData.lname || ''}&meetingEmail=${`yuvrajsingh08cs@gmail.com`}`, 'meet');
        // parent.tabClicked("meet")
    } catch (error) {
        alert("Error joining meeting: ", error.message);
    }
}

async function getMeetingDetails(pcEid) {
    try {
        const apiUrl = `http://localhost:8000/meeting/eid?pcEid=${pcEid}`
        const response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        const data = await response.json();
        if (!data) {
            throw new Error("Error getting meet data");
        }
        console.log('Meeting details:', data);
        return (data?.data)
    } catch (error) {
        alert("Error getting meeting data: ", error.message);
    }
}

async function getPatientData(pid) {
    try {
        const apiUrl = `http://localhost:8000/patient?patientId=${pid}`
        const response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        const data = await response.json();
        console.log('Patient details:', data);
        if (!data) {
            throw new Error("Error getting patient data");
        }
        return (data?.data)
    } catch (error) {
        alert("Error getting Patient data: ", error.message);
    }
}

async function initiateMeet(eid, pid) {
    try {
        console.log("Initiating")
        const [meetDetails, patientDetails] = await Promise.all([
            getMeetingDetails(eid),
            getPatientData(pid)
        ])
        joinMeeting(meetDetails, patientDetails)
    } catch (error) {
        alert("Error initiating meet", error.message);
    }
}

async function startMeeting(pcEid) {
    try {
        console.log("Called");
        const apiUrl = '/bsemr/interface/zoom/startMeeting.php';
        console.log("API url: ", apiUrl);
        console.log("Current cookies:", document.cookie);

        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({ pcEid })
        });

        const data = await response.json();
        // Check if the HTTP response status is not OK (non-200)
        if (!response.ok) {
            throw new Error(`Error: ${data.message}: ${data.details}}`);
        }


        // Validate response structure
        if (!data || !data.data || !data.data.meeting_id || !data.data.password) {
            throw new Error("Invalid response format from server.");
        }

        // Extract meeting data
        const { meeting_id, password, fname, lname } = data.data;

        console.log("Response:", data);

        // Call joinMeeting with extracted data
        try {
            joinMeeting({ meeting_id, password }, { fname, lname });
        } catch (joinError) {
            throw new Error(`Failed to join meeting: ${joinError.message}`);
        }
    } catch (error) {
        // Log error to console for debugging
        console.error("Error in startMeeting:", error);

        // Show user-friendly error message
        alert(`Error: ${error.message}`);
    }
}
