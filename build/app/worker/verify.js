const puppeteer = require('puppeteer-core');
const http = require('http');

const html = process.env.html;
const answer = process.env.answer;
const successMsg = process.env.success;
const failMsg = process.env.fail;

const server = http.createServer((req, res) => {
    res.writeHead(200, {
        'Content-Type': 'text/html; charset=utf-8',
        'X-XSS-Protection': '0',
        'Content-Security-Policy': "default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob:",
    });
    res.end(html);
}).listen(8000, '127.0.0.1');

(async () => {
    const opt = {
        headless: true,
        executablePath: 'google-chrome-stable',
        args: [
            '--no-sandbox',
            '--disable-background-networking',
            '--disable-default-apps',
            '--disable-extensions',
            '--disable-gpu',
            '--disable-sync',
            '--disable-translate',
            '--hide-scrollbars',
            '--metrics-recording-only',
            '--mute-audio',
            '--no-first-run',
            '--safebrowsing-disable-auto-update',
        ],
    };

    let fail = true;
    let browser;

    try {
        browser = await puppeteer.launch(opt);
    } catch(e) {
        process.stdout.write(failMsg);
        console.error(e);
        await server.close();
        process.exit(1);
    }

    const page = await browser.newPage();
    page.setDefaultNavigationTimeout(1000);
    page.on('dialog', dialog => {
        if (dialog.type() === 'alert' && dialog.message() === 'XSS') {
            process.stdout.write(successMsg);
            fail = false;
        }
        dialog.dismiss();
    });

    try {
        await page.goto(`http://localhost:8000/?${encodeURIComponent(answer)}`, {
            waitUntil: 'networkidle2',
        });
    } catch (e) {
        // pass
    }

    await page.waitFor(500);
    await browser.close();
    if (fail) {
        process.stdout.write(failMsg);
    }

    await server.close();
})();

