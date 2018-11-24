import Header from '../../components/Header.js';
import {axiosBase} from '../../lib/utils.js';

const Index = (props) => (
    <div>
        <Header/>
        <ul>
            {props.data.users.map((user, index) => (
                <li key={user.id}>
                    <p>{user.id}</p>
                    <p>{user.name}</p>
                </li>
            ))}
        </ul>
    </div>
)


Index.getInitialProps = async function ({req}) {
    const axios = axiosBase(req.headers.cookie);
    const res = await axios.get('/user/');
    const data = res.data;

    return {
        data: data,
    };
};

export default Index;
