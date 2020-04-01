import * as React from "react";
import {$crud} from "./crud";
import * as _ from "lodash";

export class AssignChatroom extends React.Component {

    state: any = {
        groups: [],
        players: [],
        selectedPlayers: [],
        selectedGroupPlayers: [],
        searchKeyword: ""
    }

    componentDidMount() {
        $crud.retrieve("players", {
            id: this.state.group_id
        }).then(data => {
            this.setState(({...state}: any) => {
                state.players = data.players;
                return state;
            });
        })

        $crud.retrieve("chat-room",{
            access:true
        }).then(data => {
            const {groups} = data;
            this.setState({
                groups: groups
            });
        })
    }

    getGroup() {
        $crud.retrieve("chat-room", {
            id: this.state.group_id,
            access:true
        }).then(data => {
            const {group} = data;
            this.setState({
                group: group
            });
        })
    }

    save() {
        $crud.update("chat-room/player", {
            group_id: this.state.group.id,
            player_ids: this.state.group.players.map(player => player.id)
        })
    }

    assign(player_ids: any) {
        const players = player_ids.map(id => _.find(this.state.players, p => p.id == id))
        this.setState(({...state}: any) => {
            state.group.players = [
                ...state.group.players,
                ...players
            ]
            state.selectedPlayers = []
            return state;
        })
    }

    removePlayers(player_ids: any[]) {
        this.setState(({...state}: any) => {
            console.log(player_ids);
            player_ids.forEach(id => {
                _.remove(state.group.players, {
                    id: id
                });
            })
            state.selectedGroupPlayers = []
            return state;
        })
    }

    render() {

        const {players, groups, group, selectedPlayers, selectedGroupPlayers,searchKeyword} = this.state;

        return <div className="card p-2">
        <div className="row m-0 justify-content-between">
        <div className="col-6 col-lg-4 p-2">
        <div className="md-form">
        <label htmlFor={"groups"}>Chat Room</label>
            <select value={group && group.id} onChange={e => {
            this.setState({
                group: _.find(groups, g => g.id == e.target.value)
            })
        }} className="form-control" id="group_id">
        <option value="">--Select group--</option>
        {groups.map(group => <option value={group.id} key={group.id}>{group.name}</option>)}
            </select>
            </div>
            </div>
            <div className="col-lg-2 col-6 p-2 text-right">
        <br/>
        <button onClick={() => this.save()} className="btn btn-md btn-primary">Save</button>
            </div>
            </div>
            <div className="row m-0 justify-content-between">
                <div className="col-6 col-lg-4 p-2">
                    <div className="md-form row m-0">
                        <label htmlFor="groups" className="pr-2">Search</label>
                        <input type="text" className="col p-0 pl-2 pr-2" onChange={e => {
                            this.setState({
                                searchKeyword: e.target.value
                            })
                        }}/>
                    </div>
                </div>
            </div>
            <div className="row m-0">
        <div className="col-lg-5 p-2">
            <strong>Player List</strong>
        <div className="table-responsive" style={{
            maxHeight: 500,
                overflow: 'auto'
        }}>
            <table className="table table-bordered table-hover">
            <thead>
                <tr className="text-center">
                <td>Sr.No:</td>
        <td>Profile Pic</td>
        <td>Name</td>
        <td>Username</td>
        <td><input type="checkbox" id="all-player" aria-label="Select All Player"/></td>
            </tr>
            </thead>
            <tbody>
            {
                group && players.filter(player => (searchKeyword ? player.name.toLowerCase().includes(searchKeyword.toLowerCase()) : player.name === player.name) && !_.find(group.players, p => p.id === player.id)).map((player, i) =>
                //group && players.filter(player => !_.find(group.players, p => p.id === player.id)).map((player, i) =>
                <tr className="text-center" key={player.id}>
        <td>{i + 1}</td>
        <td>
        <img className="rounded-circle player-profile-pic" src={player.image.url}/>
        </td>
        <td>{player.name}</td>
        <td>{player.user.username}</td>
        <td>
        <input checked={selectedPlayers.indexOf(player.id) !== -1} onChange={e => {
            const {checked} = e.currentTarget;
            this.setState(({...state}: any) => {
                if (checked) {
                    state.selectedPlayers.push(player.id)
                } else {
                    _.pull(selectedPlayers, player.id);
                }
                return state;
            })
        }} type="checkbox" className="player_id" value="" name="player_ids[]"
            aria-label="Assign player to Group"/>
                </td>
                </tr>
        )}
            </tbody>
            </table>
            </div>
            </div>
            <div className="col-lg-2 text-center" style={{
            maxHeight: 500,
                paddingTop: 100
        }}>
            <div className="mb-3">
            <button onClick={() => this.assign(selectedPlayers)}
            className="btn btn-md btn-primary assign-chatroom"><i className="fa fa-angle-right"></i>
            </button>
            </div>
            <div>
            <button onClick={() => this.removePlayers(selectedGroupPlayers)}
            className="btn btn-md btn-primary"><i className="fa fa-angle-left"></i></button>
        </div>
        </div>
            {group && <div className="col-lg-5 p-2 assignPlayers">
                <strong>Group Name : </strong><span id="group_name">{group.name}</span>
            <strong className="float-right">Players In Group : <span
                id="group_players">{group.players.length}</span> </strong>
            <div className="table-responsive" style={{
                maxHeight: 500,
                    overflow: 'auto'
            }}>
                <table className="table table-bordered table-hover ">
                <thead>
                    <tr className="text-center">
                    <td>Sr.No:</td>
            <td>Profile Pic</td>
            <td>Name</td>
            <td>Username</td>
            <td><input type="checkbox" id="remove-all-player" aria-label="Remove All Player"/></td>
                </tr>
                </thead>
                <tbody className="groupPlayersTable">
                {
                    group.players.map((player, i) =>
                        <tr className="text-center" key={player.id}>
                    <td>{i + 1}</td>
                    <td>
                    <img className="rounded-circle player-profile-pic" src={player.image.url}/>
            </td>
            <td>{player.name}</td>
            <td>{player.user.username}</td>
            <td>
            <input checked={selectedGroupPlayers.indexOf(player.id) !== -1}
                onChange={e => {
                const {checked} = e.currentTarget;
                this.setState(({...state}: any) => {
                    if (checked) {
                        state.selectedGroupPlayers.push(player.id)
                    } else {
                        _.pull(selectedGroupPlayers, player.id);
                    }
                    return state;
                })
            }} type="checkbox" className="player_id" value="" name="player_ids[]"
                aria-label="Assign player to Group"/>
                    </td>
                    </tr>
            )}
                </tbody>
                </table>
                </div>
                </div>
            }
            </div>
            </div>
        }
    }
