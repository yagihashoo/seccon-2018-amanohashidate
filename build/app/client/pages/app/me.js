import Layout from '../../components/layout';
import {axiosBase} from '../../lib/utils.js';

const Index = (props) => (
    <Layout title={"Profile"}>
        <div id="table" className="siimple-table siimple-table--striped">
            <div className="siimple-table-header">
                <div className="siimple-table-row">
                    <div className="siimple-table-cell">name</div>
                    <div className="siimple-table-cell">value</div>
                </div>
            </div>
            <div className="siimple-table-body">
                <div className="siimple-table-row">
                    <div className="siimple-table-cell">id</div>
                    <div className="siimple-table-cell">{props.user.id}</div>
                </div>
                <div className="siimple-table-row">
                    <div className="siimple-table-cell">name</div>
                    <div className="siimple-table-cell">{props.user.name}</div>
                </div>
            </div>
        </div>
    </Layout>
)


Index.getInitialProps = async function ({req, res}) {
    const axios = axiosBase(req);
    let apiRes;
    try {
        apiRes = await axios.get('/me');
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
            data: {users: []},
        };
    }

    return {
        user: apiRes.data,
    };
};

export default Index;
