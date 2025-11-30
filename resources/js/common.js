const nl2br = (str) => {
    if (!str) return ""; // nullやundefinedでも対応

    let res = str.replace(/\r\n/g, "<br>");
    res = res.replace(/(\n|\r)/g, "<br>");

    return res;
}

export { nl2br }
