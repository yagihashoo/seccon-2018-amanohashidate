import Head from 'next/head';
import Link from 'next/link';

const Layout = ({children, title = 'Challenges'}) => (
    <div id="wrap">
        <Head>
            <title>{`${title} - XSS Hell`}</title>
            <link rel="stylesheet" href="/static/siimple.min.css"/>
            <link rel="stylesheet" href="/static/app.css"/>
        </Head>
        <header className="siimple-navbar">
            <Link href={"/app"}>
                <a className="siimple-navbar-title siimple-link">XSS Hell</a>
            </Link>
            <div className="siimple--float-right">
                <Link href={"/app"}>
                    <a className="siimple-navbar-item siimple-link">Challenges</a>
                </Link>
                <Link href={"/app/upload"}>
                    <a className="siimple-navbar-item siimple-link">Upload</a>
                </Link>
                <Link href={"/app/upgrade"}>
                    <a className="siimple-navbar-item siimple-link">Upgrade</a>
                </Link>
                <Link href={"/app/unsolved"}>
                    <a className="siimple-navbar-item siimple-link">Unsolved</a>
                </Link>
                <Link href={"/app/me"}>
                    <a className="siimple-navbar-item siimple-link">Profile</a>
                </Link>
                <Link href={"/logout"}>
                    <a className="siimple-navbar-item siimple-link">Logout</a>
                </Link>
            </div>
        </header>
        <div className="siimple-rule"></div>
        <div className="content">
            <h2>{title}</h2>
            {children}
        </div>
        <div className="siimple-rule"></div>
        <footer>
            ©Yu YAGIHASHI, Developed For SECCON CTF 2018
        </footer>
    </div>
);

export default Layout;
