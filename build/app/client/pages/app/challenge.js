import Layout from '../../components/layout';
import Link from 'next/link';
import {withRouter} from 'next/router'
import {axiosWrapper} from "../../lib/utils";
import bulma from 'bulma';

const Challenge = withRouter((props) => (
    <Layout title={"Challenge"}>
        <ul>
            <li>Title: {props.challenge.title}</li>
            <li>Created at: {props.challenge.created_at}</li>
            <li>Updated at: {props.challenge.updated_at}</li>
            <li><Link href={`/challenge/${props.challenge.file_id}`}>
                <button className={bulma.button + ' ' + bulma['is-link']}>Donwload</button>
            </Link></li>
        </ul>
        <form>
            <h3 className={bulma.title + ' ' + bulma['is-3']}>Payload submission</h3>
            <input className={bulma.input} type="text" name="payload" placeholder="#alert(/XSS/.source)"/>
            <input className={bulma.button} type="submit" value="submit"/>
        </form>
        <style jsx>{`
            form {
                margin-top: 30px;
            }
        `}</style>
    </Layout>
));

Challenge.getInitialProps = async function ({req, res, query: {id}}) {
    const axios = (new axiosWrapper(req)).axios;
    let challenge;
    try {
        challenge = await axios.get(`/challenge/${id}`);
    } catch (err) {
        const status = err.response.status;
        switch (status) {
            case 401:
                res.redirect('/login');
                res.end();
                break;
            default:
                res.end();
        }

        return {
            challenge: {},
        };
    }

    return {
        challenge: challenge.data,
    };
};

export default Challenge;
