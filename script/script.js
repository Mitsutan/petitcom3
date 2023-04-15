function sendhttpreq(htmlid, prjid, loginid) {
    const data = {
        "htmlid": htmlid,
        "prjid": prjid,
        "loginid": loginid
    }

    const json = JSON.stringify(data);
    console.log(json);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "./php/project.php");
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
    xhr.send(json);
    xhr.onreadystatechange = function () {
        try {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    const result = JSON.parse(xhr.response);
                    document.getElementById(htmlid).disabled = true;
                    const num = document.getElementById(htmlid + "num");
                    num.innerText = Number(num.innerText) + 1;
                    console.log(result);
                } else {
                    alert("failed");
                }
            } else {
                
            }
        } catch (e) {
            console.log(e);
        }
    }
}