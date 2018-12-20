const puppeteer = require('puppeteer-core');
const http = require('http');

const html = process.env.html;
const answer = process.env.answer;
const successMsg = process.env.success;
const failMsg = process.env.fail;

const server = http.createServer((req, res) => {
    res.writeHead(200, {
        'Content-Type': 'text/html; charset=utf-8',
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
        console.log(failMsg);
        console.error(e);
        process.exit(1);
    }

    const page = await browser.newPage();
    page.setDefaultNavigationTimeout(1000);
    page.on('dialog', async dialog => {
        if (dialog.type() === 'alert' && dialog.message() === 'XSS') {
            process.stdout.write(successMsg);
            fail = false;
        }
        dialog.dismiss();
    });

    try {
        await page.goto(`http://localhost:8000/?${answer}`, {
            waitUntil: 'networkidle2',
        });
    } catch (e) {
        console.error(e);
    }

    await page.waitFor(500);
    await browser.close();
    if (fail) {
        process.stdout.write(failMsg);
    }

    server.close();
})();

