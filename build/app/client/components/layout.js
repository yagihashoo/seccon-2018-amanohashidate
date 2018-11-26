import Head from 'next/head';
import Link from 'next/link';

const Layout = ({children, title = 'XSS Hell'}) => (
    <div id="wrap">
        <Head>
            <title>{title}</title>
            <link rel="stylesheet" href="/css/siimple.min.css"/>
            <link rel="stylesheet" href="/css/app.css"/>
        </Head>
        <header className="siimple-navbar">
            <a className="siimple-navbar-title">XSS Hell</a>
            <div className="siimple--float-right">
                <Link href="/app">
                    <a className="siimple-navbar-item">Challenges</a>
                </Link>
                <Link href="/app/upload">
                    <a className="siimple-navbar-item">Upload Challenge</a>
                </Link>
                <Link href="/app/upgrade">
                    <a className="siimple-navbar-item">Upgrade Account</a>
                </Link>
                <Link href="/app/unsolved">
                    <a className="siimple-navbar-item">Unsolved Challenges</a>
                </Link>
                <Link href="/logout">
                    <a className="siimple-navbar-item">Logout</a>
                </Link>
            </div>
        </header>
        <div className="siimple-rule"></div>
        <div class="content">{children}</div>
        <div className="siimple-rule"></div>
        <footer>
            ©Yu YAGIHASHI, Developed For SECCON CTF 2018
        </footer>
        <style jsx>{`
            header {
                padding: 20px;
            }

            footer {
                text-align: right;
                padding: 20px;
            }
        `}</style>
    </div>
);

export default Layout;