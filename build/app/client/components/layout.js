import Head from 'next/head';
import Link from 'next/link';

const Layout = ({children, title = 'XSS Hell'}) => (
    <div>
        <Head>
            <title>{title}</title>
        </Head>
        <header>
            <Link href="/">
                <a>Challenges</a>
            </Link>
            <Link href="/upload">
                <a>Upload Challenge</a>
            </Link>
            <Link href="/upgrade">
                <a>Upgrade account</a>
            </Link>
            <Link href="/unsolved">
                <a>Unsolved Challenges</a>
            </Link>
        </header>
        <div id="wrap">{children}</div>
        <footer>
        </footer>
        <style jsx>{`
        a {
            color: red;
        }

        a:hover {
            color: blue;
        }
        `}</style>
    </div>
);

export default Layout;