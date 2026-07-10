const fs = require('fs');
let html = fs.readFileSync('app/Views/kalender.html', 'utf8');

// Revert isIstikmal
html = html.replace(
/function isIstikmal\(date\) \{[\s\S]*?return set\.includes[^\}]*\}/,
`function isIstikmal(date) {
        const set = getIstikmalMonths();
        const hParts = getHijriPartsNative(date);
        let mBase = hParts.hMonth;
        let yBase = hParts.hYear;
        let pM = (mBase === 0) ? 11 : mBase - 1;
        let pY = (mBase === 0) ? yBase - 1 : yBase;
        return set.includes(\`\${pY}-\${pM}\`);
      }`
);

// Fix cbIstikmal in renderCalendar (it used firstDay)
html = html.replace(
/const hPartsFirst = getHijriPartsNative\(firstDay\);[\s\S]*?const monthKey = \`\$\{prevY\}-\$\{prevM\}\`;/,
`// Use the middle of the month to determine the primary Hijri month for the checkbox
        const midMonth = new Date(activeYear, activeMonth, 15);
        const hPartsFirst = getHijriPartsNative(midMonth);
        let mBase = hPartsFirst.hMonth;
        let yBase = hPartsFirst.hYear;
        let prevM = (mBase === 0) ? 11 : mBase - 1;
        let prevY = (mBase === 0) ? yBase - 1 : yBase;
        const monthKey = \`\${prevY}-\${prevM}\`;`
);

// Add deduplication in renderCalendar for the list
html = html.replace(
/if \(allMonthEvents\.length === 0\) \{/,
`// Deduplicate events that might appear on multiple adjacent days due to Istikmal paradox
          let uniqueEvents = [];
          let seenKeys = new Set();
          allMonthEvents.forEach(ev => {
             let key = ev.id + '-' + ev.hDay + '-' + ev.hMonth;
             if (!seenKeys.has(key)) {
                 seenKeys.add(key);
                 uniqueEvents.push(ev);
             }
          });
          allMonthEvents = uniqueEvents;

          if (allMonthEvents.length === 0) {`
);

fs.writeFileSync('app/Views/kalender.html', html);
console.log("Patched kalender.html");
