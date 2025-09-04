function loadVoteBar(cid, uid) {
    getVotes(cid, uid);
    document.querySelectorAll('div.voteable[data-cid="'+cid+'"] .dovote').forEach((el) => {
        el.addEventListener('click', (e) => {
            console.log(e);
            console.log(el);
            vote(cid, uid, el.dataset.val);
        });
    });
}

function getVotes(cid, uid) {
    fetch('/api/vote.php?cid='+cid+'&uid='+uid).then((r) => r.json()).then((r) => {
        document.querySelector('div.voteable[data-cid="'+cid+'"] .votes').innerText = r.val?? '?';
        if(r.voted) { // already voted ! remove buttons
            document.querySelectorAll('div.voteable[data-cid="'+cid+'"] .dovote').forEach(e => e.remove());
        }
    });
}

function vote(cid, uid, val) {
    fetch('/api/vote.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({'cid': cid, 'uid': uid, 'val': val})
    }).then((r) => r.json()).then((r) => {
        getVotes(cid, uid);
    });
}

