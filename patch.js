const fs = require('fs');
let html = fs.readFileSync('app/Views/kalender.html', 'utf8');

html = html.replace(
/function getHijriParts\(date\) \{[\s\S]*?return getHijriPartsNative\(targetDate\);\s*\}/,
`function getHijriParts(date) {
        // Global Kemenag/NU Offset (-1 day from Umm al-Qura)
        const baseDate = new Date(date.getTime() - 86400000);
        const hasIstikmal = isIstikmal(baseDate);
        const targetDate = hasIstikmal ? new Date(baseDate.getTime() + 86400000) : baseDate;
        return getHijriPartsNative(targetDate);
      }`
);

fs.writeFileSync('app/Views/kalender.html', html);
console.log('Patched');
