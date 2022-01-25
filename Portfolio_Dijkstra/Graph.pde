class Graph{
  NodeSet ns; //グラフ上の頂点集合
  EdgeSet es; //グラフ上の辺集合
  
  Graph(String[] data ){
    ns = new NodeSet( int( split( data[ 0 ] , "," ) )[0] );
    es = new EdgeSet( data, ns );
  }
  
  // 頂点 s から頂点 t に向かう最短経路の距離を返す
  int dijkstra( Node s, Node t ){ 
    s.dist = 0; //頂点 s が持つ距離を 0 とする．
    NodeSet waitingNodes = ns.clone(); //waitingNodes を最短経路が未確定の頂点の集合とする
    while( waitingNodes.size() > 0 ){ //未確定の頂点集合が空でない場合は繰り返す
      Node u = waitingNodes.removeMinDistNode(); //未確定の頂点集合から，暫定最短距離が最小の頂点を取り出す
      //暫定距離が最小の Node の dist が無限であった場合，
      //または暫定距離が最小の Node が 頂点 t だった場合 ( = 頂点 t の最短距離が確定した場合 ) は処理を終了する
      if( u.dist >= Integer.MAX_VALUE || u == t ) break; 
      u.outGoing.update();
    }
    return t.dist;
  }
  
}
